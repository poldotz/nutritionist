<?php

namespace Nutritionist\StoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nutritionist\StoreBundle\Entity\Food;
use Nutritionist\StoreBundle\Form\FoodType;

/**
 * Food controller.
 *
 * @Route("/food")
 */
class FoodController extends Controller
{
    /**
     * Lists all Food entities.
     *
     * @Route("/", name="food")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NutritionistStoreBundle:Food')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Food entity.
     *
     * @Route("/", name="food_create")
     * @Method("POST")
     * @Template("NutritionistStoreBundle:Food:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Food();
        $form = $this->createForm(new FoodType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('food_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Food entity.
     *
     * @Route("/new", name="food_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Food();
        $form   = $this->createForm(new FoodType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Food entity.
     *
     * @Route("/{id}", name="food_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NutritionistStoreBundle:Food')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Food entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Food entity.
     *
     * @Route("/{id}/edit", name="food_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NutritionistStoreBundle:Food')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Food entity.');
        }

        $editForm = $this->createForm(new FoodType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Food entity.
     *
     * @Route("/{id}", name="food_update")
     * @Method("PUT")
     * @Template("NutritionistStoreBundle:Food:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NutritionistStoreBundle:Food')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Food entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new FoodType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('food_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Food entity.
     *
     * @Route("/{id}", name="food_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NutritionistStoreBundle:Food')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Food entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('food'));
    }

    /**
     * Creates a form to delete a Food entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
