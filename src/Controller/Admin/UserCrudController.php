<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Utilisateurs')
            ->setEntityLabelInSingular('Utilisateur')
            ->setPageTitle("index","UtopiaZoo - Administration des utilisateurs")
            ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            TextField::new('first_name'),
            TextField::new('name'),
            EmailField::new('email'),
            TextField::new('address')
            ->hideOnIndex(),
            ArrayField::new('roles'),
            DateTimeField::new('date_inscription')
            ->setFormTypeOption('disabled','disabled'),
        ];
    }
}
