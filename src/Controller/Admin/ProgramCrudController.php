<?php

namespace App\Controller\Admin;

use App\Entity\Program;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ProgramCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Program::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Programmes')
            ->setEntityLabelInSingular('Programme')
            ->setPageTitle("index","UtopiaZoo - Administration des programmes")
            ->setPaginatorPageSize(12)
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            TextField::new('title'),
            DateTimeField::new('date_deb'),
            DateTimeField::new('date_fin'),
            TextareaField::new('description_program')
                ->setFormType(CKEditorType::class)
                ->hideOnIndex(),
            IntegerField::new('age_min'),
            TextField::new('pictureDecoPath')
            ->hideOnIndex()
            ->hideOnForm(),
        ];
    }

}
