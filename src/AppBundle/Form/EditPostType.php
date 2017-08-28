<?php

namespace AppBundle\Form;

use AppBundle\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TextTypeForm;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditPostType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('title', TextTypeForm::class,
				array('label' => 'Podaj tytuł posta'))
			->add('body',TextareaType::class,
				array('label' => 'Tutaj treść posta'))
			->add('attachment',FileType::class,
				array('label' => 'Dołącz plik do posta',
					'data_class' => null,
					'required' => false
				));
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			array(
				'data_class' => Post::class,
			)));
	}
}