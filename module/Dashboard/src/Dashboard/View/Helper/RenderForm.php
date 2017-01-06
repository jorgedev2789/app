<?php
namespace Dashboard\View\Helper;

use Zend\View\Helper\AbstractHelper;

class RenderForm extends AbstractHelper {

    public function __invoke($form) {
        $form->prepare();
        $html = $this->view->form()->openTag($form) . PHP_EOL;
        $html .= $this->renderFieldsets($form->getFieldsets());
        $html .= $this->renderElements($form->getElements());
        $html .= $this->view->form()->closeTag($form) . PHP_EOL;
        return $html;
    }

    public function renderFieldsets($fieldsets) {

        foreach ($fieldsets as $fieldset) {
            if (count($fieldset->getFieldsets()) > 0) {
                $html = $this->renderFieldsets($fieldset->getFieldsets());
            } else {
                $html = '<fieldset>';
                    // You can use fieldset's name for the legend (if that's not inappropriate)
                    $html .= '<legend>' . ucfirst($fieldset->getName()) . '</legend>';
                    // or it's label (if you had set one)
                    // $html .= '<legend>' . ucfirst($fieldset->getLabel()) . '</legend>';
                    $html .= $this->renderElements($fieldset->getElements());
                $html .= '</fieldset>';
                // I actually never use the <fieldset> html tag.
                // Feel free to use anything you like, if you do have to
                // make grouping certain elements stand out to the user
            }
        }

        return $html;
    }

    public function renderElements($elements) {
        $html = '';
        foreach ($elements as $element) {
            $html .= $this->renderElement($element);
        }
        return $html;
    }

    public function renderElement($element) {
        // FORM ROW
        $html = '<div class="form-group">';

        // LABEL
        if (!empty($element->getLabel())) {
            $html .= '<label class="form-label" for="' . $element->getAttribute('id') . '">' . $element->getLabel() . '</label>'; # add translation here
        }

        // ELEMENT
        /*
         - Check if element has error messages
         - If it does, add my error-class to the element's existing one(s),
           to style the element differently on error
        */
        if (count($element->getMessages()) > 0) {
            $classAttribute = ($element->hasAttribute('class') ? $element->getAttribute('class') . ' ' : '');
            $classAttribute .= 'parsley-error';

            $element->setAttribute('class', $classAttribute);
        }
        $html .= $this->view->formElement($element);

        // ERROR MESSAGES
        $html .= $this->view->FormElementErrors($element, array('class' => 'parsley-required'));


        $html .= '</div>'; # /.row
        //$html .= '<div class="clearfix" style="height: 15px;"></div>';

        return $html . PHP_EOL;
    }

}