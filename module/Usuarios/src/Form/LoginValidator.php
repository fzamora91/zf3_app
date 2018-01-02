<?php
namespace Usuarios\Form;
use Zend\InputFilter\InputFilter;
class LoginValidator extends InputFilter
{
	public function __construct()
	{
		$this->add(['name'=>'email',
                    'validators'=>[[
                       'name'=>'EmailAddress'
                    ],],
	    ]);
		$this->add(['name'=>'password',
			        'filters'=>[
                      ['name'=>'StripTags'],
                      ['name'=>'StringTrim'],
			        ],
                    'validators'=>[
                    	[
                       'name'=>'StringLength',
                       'options'=>[
                           'min'=>3,
                           'max'=>8,
                       ],
                       ],
                       /*[
                       'name'=>'Alnum'
                       ]*/
                     ],
	    ]);
	}
}