<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('username', TextType::class)
			->add('email', EmailType::class)
			->add('phone', NumberType::class)
			->add('password', RepeatedType::class, array(
				'type' => PasswordType::class,
				'first_options' => array('label' => 'Hasło'),
				'second_options' => array('label' => 'Powtórz hasło'),
			));
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			array(
				'data_class' => User::class,
		)));
	}
}