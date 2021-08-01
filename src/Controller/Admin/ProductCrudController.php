<?php

namespace App\Controller\Admin;

use App\DBAL\Types\ProductTypeEnumType;
use App\Entity\Product;
use App\Form\GenreType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'Titre'),
            CountryField::new('country', 'Nationalité')
                ->useAlpha3Codes(),
            IntegerField::new('year', 'Année')
                ->setFormTypeOptions(['attr' => ['max' => Product::MAX_YEAR]]),
            TextField::new('original_title', 'Titre Original'),
            TextEditorField::new('description'),
            AssociationField::new('genre'),
            IntegerField::new('ranking', 'Note')
                ->setFormTypeOptions(['attr' => ['min' => Product::MIN_RANKING, 'max' => Product::MAX_RANKING]]),
            MoneyField::new('price', 'Prix')
                ->setCurrency('EUR')
                ->setStoredAsCents(false),
            ChoiceField::new('product_type', 'Type de produit')
                ->setChoices(fn () => ProductTypeEnumType::getChoices()),            
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        $product = new Product();
        $product->setYear(date('Y'))
            ->setCountry('FRA');

        return $product;
    }

}
