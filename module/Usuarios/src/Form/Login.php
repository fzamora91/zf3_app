<?php
namespace Usuarios\Form;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Form\Element\Email;
use Zend\Form\Element\Password;

use Zend\Captcha;


class Login extends Form
{
	public function __construct($name = null)
	{
       parent::__construct($name);
       $this->add(['type'=>Email::class,
       	           'name'=>'email',
       	           'attributes'=>['class'=>'form-control'],
                   'options'=>['label'=>'Email',
                     'label_attributes'=>['class'=>'col-sm-2']
                   ]
       ]);

       $this->add(['type'=>Password::class, 
       	           'name'=>'password', 
       	           'attributes'=>['class'=>'form-control'],
                   'options'=>['label'=>'Password',
                     'label_attributes'=>['class'=>'col-sm-2']
                   ]         
       	]);

       $this->add(['type' => 'Zend\Form\Element\Captcha',
                   'name' => 'captcha',
                   'attributes'=>['class'=>'form-control'],
                   'options' => [
                       'label' => 'Es humano?',
                       'label_attributes'=>['class'=>'col-sm-2'],
                        'captcha' => new Captcha\Dumb(),
                     ],
                 ]);

       $this->add(['name'=>'send',
       	           'attributes'=>[
       	           	 'type'=>'submit',
                     'value'=>'login',
                     'class'=>'btn btn-primary',
       	           	]]);
	}
}