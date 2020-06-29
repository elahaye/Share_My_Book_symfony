<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Booklist;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends AbstractFixture
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function loadData(ObjectManager $manager)
    {
        // Users
        $this->createMany(User::class, 20, function (User $user, $u) {
            $user->setEmail("user$u@gmail.com")
                ->setNickname($this->faker->name())
                ->setAvatar($this->faker->imageUrl(250, 250))
                ->setRegistrationDate($this->faker->dateTimeBetween('-6 months'))
                ->setRoles(["ROLE_USER"])
                ->setPassword($this->encoder->encodePassword($user, "password"));
        });

        $admin = new User();
        $admin->setEmail("admin@gmail.com")
            ->setNickname("Administrator")
            ->setAvatar($this->faker->imageUrl(250, 250))
            ->setRegistrationDate($this->faker->dateTimeBetween('-6 months'))
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword($this->encoder->encodePassword($admin, "password"));

        $manager->persist($admin);
        $manager->flush();

        // Books
        $this->createMany(Book::class, 100, function (Book $book) {
            $book->setTitle($this->faker->catchPhrase)
                ->setReferenceApi($this->faker->userName)
                ->setSummary($this->faker->paragraphs(2, true))
                ->setAuthor($this->faker->name())
                ->setTotalPages($this->faker->numberBetween(100, 500))
                ->setPublicationDate($this->faker->dateTimeBetween('-10 years'));
        });

        // Categories
        $categories = ["romance", "fantasy", "aventure", "thriller", "science-fiction", "historique", "culinaire", "développement personnel", "scolaire"];

        for ($i = 0; $i < count($categories); $i++) {
            $category = new Category;
            $category->setName($categories[$i]);

            $manager->persist($category);
            $manager->flush();
        }

        // Booklists
        $this->createMany(BookList::class, 20, function (Booklist $bookList) {
            $bookList->setName($this->faker->catchPhrase())
                ->setCreatorId($this->getRandomReference(User::class))
                ->setCreatedAt($this->faker->dateTimeBetween('-1 month'))
                ->setStatus("public");

            for ($i = 0; $i < 10; $i++) {
                $bookList->addBook($this->getRandomReference(Book::class));
            }
        });
    }
}
