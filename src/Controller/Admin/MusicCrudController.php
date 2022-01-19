<?php

namespace App\Controller\Admin;

use App\Entity\Music;
use App\Entity\artist;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichFileType;
class MusicCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Music::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('title_m'),
            AssociationField::new('artist'),
            AssociationField::new('album'),
            Field::new('date'),
            TextField::new('audioFile')->setFormType(VichFileType::class)->onlyWhenCreating(),
            
        ];
    }
    
}

