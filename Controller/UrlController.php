<?php

namespace Acme\DiggBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DiggBundle\Entity\Url;
use Acme\DiggBundle\Form\UrlType;

/**
 * Url controller.
 *
 * @Route("/url")
 */
class UrlController extends Controller
{
    /**
     * Lists all Url entities.
     *
     * @Route("/", name="url")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('AcmeDiggBundle:Url')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Url entity.
     *
     * @Route("/{id}/show", name="url_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeDiggBundle:Url')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Url entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Url entity.
     *
     * @Route("/new", name="url_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Url();
        $form   = $this->createForm(new UrlType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Url entity.
     *
     * @Route("/create", name="url_create")
     * @Method("post")
     * @Template("AcmeDiggBundle:Url:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Url();
        $request = $this->getRequest();
        $form    = $this->createForm(new UrlType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('url_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Url entity.
     *
     * @Route("/{id}/edit", name="url_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeDiggBundle:Url')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Url entity.');
        }

        $editForm = $this->createForm(new UrlType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Url entity.
     *
     * @Route("/{id}/update", name="url_update")
     * @Method("post")
     * @Template("AcmeDiggBundle:Url:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeDiggBundle:Url')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Url entity.');
        }

        $editForm   = $this->createForm(new UrlType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('url_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Url entity.
     *
     * @Route("/{id}/delete", name="url_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('AcmeDiggBundle:Url')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Url entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('url'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
