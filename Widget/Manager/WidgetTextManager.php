<?php

namespace Victoire\TextBundle\Widget\Manager;


use Victoire\TextBundle\Form\WidgetTextType;
use Victoire\TextBundle\Entity\WidgetText;

class WidgetTextManager
{
protected $container;

    /**
     * constructor
     *
     * @param ServiceContainer $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * create a new WidgetText
     * @param Page   $page
     * @param string $slot
     *
     * @return $widget
     */
    public function newWidget($page, $slot)
    {
        $widget = new WidgetText();
        $widget->setPage($page);
        $widget->setslot($slot);

        return $widget;
    }
    /**
     * render the WidgetText
     * @param Widget $widget
     *
     * @return widget show
     */
    public function render($widget)
    {
        return $this->container->get('victoire_templating')->render(
            "VictoireTextBundle:Widget:text/show.html.twig",
            array(
                "widget" => $widget
            )
        );
    }

    /**
     * render WidgetText form
     * @param Form           $form
     * @param WidgetText $widget
     * @return form
     */
    public function renderForm($form, $widget)
    {
        return $this->container->get('victoire_templating')->render(
            "VictoireTextBundle:Widget:text/edit.html.twig",
            array(
                'widget' => $widget,
                'form' => $form->createView(),
                'id' => $widget->getId()
            ));
    }

    /**
     * create a form with given widget
     * @param WidgetText $widget
     * @return $form
     */
    public function buildForm($widget)
    {
        $form = $this->container->get('form.factory')
                     ->create(new WidgetTextType(), $widget);

        return $form;
    }

    /**
     * create form new for WidgetText
     * @param Form           $form
     * @param WidgetText $widget
     * @param string         $slot
     * @param Page           $page
     *
     * @return new form
     */
    public function renderNewForm($form, $widget, $slot, $page)
    {

        return $this->container->get('victoire_templating')->render(
            "VictoireTextBundle:Widget:text/new.html.twig",
            array(
                "widget" => $widget,
                'form' => $form->createView(),
                "slot" => $slot,
                "renderContainer" => true,
                "page" => $page
            )
        );
    }
}
