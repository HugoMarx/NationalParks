<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StateSearchType extends AbstractType
{

    public const US_STATES = [
        "All" => 'all',
        "Alaska" => "AK",
        "Alabama" => "AL",
        "Arkansas" => "AR",
        "American Samoa" => "AS",
        "Arizona" => "AZ",
        "California" => "CA",
        "Colorado" => "CO",
        "Connecticut" => "CT",
        "District of Columbia" => "DC",
        "Delaware" => "DE",
        "Florida" => "FL",
        "Georgia" => "GA",
        "Guam" => "GU",
        "Hawaii" => "HI",
        "Iowa" => "IA",
        "Idaho" => "ID",
        "Illinois" => "IL",
        "Indiana" => "IN",
        "Kansas" => "KS",
        "Kentucky" => "KY",
        "Louisiana" => "LA",
        "Massachusetts" => "MA",
        "Maryland" => "MD",
        "Maine" => "ME",
        "Michigan" => "MI",
        "Minnesota" => "MN",
        "Missouri" => "MO",
        "Mississippi" => "MS",
        "Montana" => "MT",
        "North Carolina" => "NC",
        "North Dakota" => "ND",
        "Nebraska" => "NE",
        "New Hampshire" => "NH",
        "New Jersey" => "NJ",
        "New Mexico" => "NM",
        "Nevada" => "NV",
        "New York" => "NY",
        "Ohio" => "OH",
        "Oklahoma" => "OK",
        "Oregon" => "OR",
        "Pennsylvania" => "PA",
        "Puerto Rico" => "PR",
        "Rhode Island" => "RI",
        "South Carolina" => "SC",
        "South Dakota" => "SD",
        "Tennessee" => "TN",
        "Texas" => "TX",
        "Utah" => "UT",
        "Virginia" => "VA",
        "Virgin Islands" => "VI",
        "Vermont" => "VT",
        "Washington" => "WA",
        "Wisconsin" => "WI",
        "West Virginia" => "WV",
        "Wyoming" => "WY"
    ];

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('state_name', ChoiceType::class, [
                'label' => false,
                'placeholder' => 'Filter by state',
                'choices' => self::US_STATES,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
