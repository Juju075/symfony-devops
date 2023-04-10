<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', options: [
                'label' => 'Name'
            ])
            ->add('description')
            ->add('price', options: [
                'label' => 'Price'
            ])
            ->add('stock', options: [
                'label' => 'Unity in stock'
            ])
            ->add('category',
                EntityType::class,
                [
                    'class' => Category::class,
                    'choice_label' => 'name', //Liste deroulante,
                    'label'=>'caterogy',
                    'groupe_by'=> 'parent.name',
                    //requete querybuilder (selection des information souhaite) pour remplir la liste deroulante
                    'query_builder'=>function(CategoryRepository $cr)
                    {
                        return $cr->createQueryBuilder('c') //c alias de category
                            ->where('c.parent IS NOT NULL') // les enfants uniquement
                            ->orderBy('c.name', 'ASC');
                    }

                ]) // Indique que c'est une entité
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
