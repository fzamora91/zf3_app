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
       $dirdata = './data';


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
       //create a new captcha element
       $captcha = new Element\Captcha('captcha');

       //the type of captcha we'd like to use
       $captchaType = new Captcha\ReCaptcha(array(
         'private_key'=>'6Lcp9D4UAAAAADqBsG88OcGgQSxHRF3kwNe0t9yM',
         'public_key' =>'6Lcp9D4UAAAAAG0WHtQMunRuA6b4S9SoBoTw0nPP')
        );
       //can also set using methods
       $captchaType->setPrivkey('6Lc59z4UAAAAANLUtK9O2H0uYcTRShL5Cjh5cB3r');
       $captchaType->setPubkey('6Lc59z4UAAAAAB6rd9JC9TF575EGF2_JGB5pnZfW');
       $captcha->setCaptcha($captchaType);
       $captcha->setLabel('Ingrese las palabras que estan abajo.');
       $this->add($captcha);
       
       /*$this->add('captcha', 'captcha', array(
        'label' => 'Please enter two words displayed below:',
        'required' => true,
        'captcha' => array(
            'pubkey' => '------',
            'privkey' => '------',
            'captcha' => 'reCaptcha'
        )
       ));*/




      /*
       $this->add(['type' => 'Zend\Form\Element\Captcha',
                   'name' => 'captcha',
                   'attributes'=>['class'=>'form-control'],
                   'options' => [
                       'label' => 'Es humano?',
                       'label_attributes'=>['class'=>'col-sm-2'],
                        'captcha' => new Captcha\Dumb(),
                     ],
                 ]);*/


       $this->add(['name'=>'send',
       	           'attributes'=>[
       	           	 'type'=>'submit',
                     'value'=>'login',
                     'class'=>'btn btn-primary',
       	           	]]);
	}
}