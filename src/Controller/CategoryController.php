<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     */
    public function index(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/categories/delete/{id}", name="category_delete")
     */
    public function delete(Category $category, EntityManagerInterface $em)
    {
        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute("categories");
    }

    /**
     * @Route("/categories/create", name="category_create")
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(CategoryType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();

            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute("categories");
        }

        return $this->render('category/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/categories/edit/{id}", name="category_edit")
     */
    public function edit(Category $category, request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute("categories");
        }

        return $this->render('category/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
