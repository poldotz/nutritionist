<?php

namespace Nutritionist\StoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nutritionist\StoreBundle\Entity\FoodNutrient;
use Nutritionist\StoreBundle\Form\FoodNutrientType;

/**
 * FoodNutrient controller.
 *
 * @Route("/foodnutrient")
 */
class FoodNutrientController extends Controller
{
    /**
     * Lists all FoodNutrient entities.
     *
     * @Route("/", name="foodnutrient")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NutritionistStoreBundle:FoodNutrient')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new FoodNutrient entity.
     *
     * @Route("/", name="foodnutrient_create")
     * @Method("POST")
     * @Template("NutritionistStoreBundle:FoodNutrient:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new FoodNutrient();
        $form = $this->createForm(new FoodNutrientType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('foodnutrient_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new FoodNutrient entity.
     *
     * @Route("/new", name="foodnutrient_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new FoodNutrient();
        $form   = $this->createForm(new FoodNutrientType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a FoodNutrient entity.
     *
     * @Route("/{id}", name="foodnutrient_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NutritionistStoreBundle:FoodNutrient')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FoodNutrient entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing FoodNutrient entity.
     *
     * @Route("/{id}/edit", name="foodnutrient_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NutritionistStoreBundle:FoodNutrient')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FoodNutrient entity.');
        }

        $editForm = $this->createForm(new FoodNutrientType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing FoodNutrient entity.
     *
     * @Route("/{id}", name="foodnutrient_update")
     * @Method("PUT")
     * @Template("NutritionistStoreBundle:FoodNutrient:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NutritionistStoreBundle:FoodNutrient')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FoodNutrient entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new FoodNutrientType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('foodnutrient_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a FoodNutrient entity.
     *
     * @Route("/{id}", name="foodnutrient_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NutritionistStoreBundle:FoodNutrient')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FoodNutrient entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('foodnutrient'));
    }

    /**
     * Creates a form to delete a FoodNutrient entity by id.
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
