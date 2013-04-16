<?php
namespace Imavia\FacetProfileBundle\Form ;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/** Creation d'un formulaire réutilisable pour la creation de profil 
 * 
 * Creation de profil
 * 
 */

class ProfileCreationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $fb, array $options)
    {
        $fb
            ->add(
                'civilite', 'choice',
                array(
                        'choices' => array('M.' => 'Monsieur', 'Mme' => 'Madame')
                     )
            )

            ->add(
                'nom',
                'text',
                array(
                        'max_length' => 32,
                        'attr' => array('placeholder' => 'entrez votre nom')
                     )
            )
            ->add(
                'prenom',
                'text',
                array(
                        'attr' => array('placeholder' => 'entrez votre prénom')
                     )
            )

            ->add(
                'pseudo',
                'text',
                array(
                        'attr' => array('placeholder' => 'entrez votre pseudo')
                     )
            )->setAttribute('icon', 'icon-user')

            //->add('ddn', 'date', array('widget' => 'choice'))
            ->add(
                'ddn', 'date', array
                (
                    'widget' => 'choice',
                    'years' => range(date('Y') - 100, date('Y')),
                    'empty_value' => array
                     (
                        'year' => 'Année',
                        'month' => 'Mois',
                        'day' => 'Jour'),
                        'format' => 'dd  MMMM  yyyy'
                     )
            )

            ->add('photo', 'file', array('required' => false))

            ->add(
                'ligneP',
                'text',
                array(
                     'required' => false,
                     'attr' => array('placeholder' => 'Numéro d\'adresse')
                     )
            )
            ->add(
                'ligneS',
                'text',
                array(
                      'required' => false,
                      'attr' => array('placeholder' => 'Compléments d\'adresse')
                     )
            )
            ->add('codepostal', 'text', array('required' => false, 'attr' => array('placeholder' => 'Code postal')))
            ->add('ville', 'text', array('required' => false, 'attr' => array('placeholder' => 'Ville')))
            ->add('pays', 'country', array('required' => false))

             ->add(
                 'telephoneP',
                 'text',
                 array(
                      'required' => false,
                      'attr' => array('placeholder' => 'Téléphone principal')
                      )
             )

            ->add(
                'telephoneS',
                'text',
                array(
                    'required' => false,
                    'attr' => array('placeholder' => 'Téléphone secondaire')
                    )
            )
            ->add(
                'mail',
                'email',
                array(
                    'attr' => array('placeholder' => 'Mail principal')
                    )
            )
            ->add(
                'mailsecours',
                'email',
                array(
                      'required' => false,
                      'attr' => array('placeholder' => 'Mail secondaire')
                      )
            )
            ->add('facebook', 'url', array('required' => false))
            ->add('googleplus', 'url', array('required' => false))
            ->add('twitter', 'url', array('required' => false))
            ->add('skype', 'text', array('required' => false))
            ->add('viadeo', 'url', array('required' => false))
            ->add('linkedin', 'url', array('required' => false));

        $form = $fb->getForm();

        return $form ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
            'data_class' => 'Imavia\FacetProfileBundle\ProfileModel\AttributeModel'
            )
        );
    }

    public function getName()
    {
        return 'imavia_facetprofilebundle_profilecreationtype';
    }

}

