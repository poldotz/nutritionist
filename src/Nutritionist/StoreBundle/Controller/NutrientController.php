<?php

namespace Nutritionist\StoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nutritionist\StoreBundle\Entity\Nutrient;
use Nutritionist\StoreBundle\Form\NutrientType;

/**
 * Nutrient controller.
 *
 * @Route("/nutrient")
 */
class NutrientController extends Controller
{
    /**
     * Lists all Nutrient entities.
     *
     * @Route("/", name="nutrient")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NutritionistStoreBundle:Nutrient')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Nutrient entity.
     *
     * @Route("/", name="nutrient_create")
     * @Method("POST")
     * @Template("NutritionistStoreBundle:Nutrient:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Nutrient();
        $form = $this->createForm(new NutrientType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nutrient_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Nutrient entity.
     *
     * @Route("/new", name="nutrient_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Nutrient();
        $form   = $this->createForm(new NutrientType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Nutrient entity.
     *
     * @Route("/{id}", name="nutrient_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NutritionistStoreBundle:Nutrient')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nutrient entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Nutrient entity.
     *
     * @Route("/{id}/edit", name="nutrient_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NutritionistStoreBundle:Nutrient')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nutrient entity.');
        }

        $editForm = $this->createForm(new NutrientType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Nutrient entity.
     *
     * @Route("/{id}", name="nutrient_update")
     * @Method("PUT")
     * @Template("NutritionistStoreBundle:Nutrient:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NutritionistStoreBundle:Nutrient')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nutrient entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new NutrientType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nutrient_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Nutrient entity.
     *
     * @Route("/{id}", name="nutrient_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NutritionistStoreBundle:Nutrient')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Nutrient entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('nutrient'));
    }

    /**
     * Creates a form to delete a Nutrient entity by id.
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
