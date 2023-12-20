<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Contact;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname'),
            TextField::new('lastname'),
            EmailField::new('email'),
            TelephoneField::new('phone'),
            AssociationField::new('category')
                ->formatValue(function ($value) {
                    return $value ? $value->getName() : 'null';
                })
                ->setFormTypeOptions([
                    'choice_label' => 'name',
                    'required' => false,
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('c')
                            ->orderBy('c.name', 'ASC');
                    },
                ]),
        ];
    }
}
