<?php

namespace App\EventListeners;

use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\Patient;
use Nzo\UrlEncryptorBundle\Encryptor\Encryptor;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class PatientListener
{
    private $params;
    private $session;
    private $logger;

    public function __construct(ParameterBagInterface $params, 
                                 Session $session, LoggerInterface $logger)
    {
        $this->params = $params;
        $this->session = $session;
        $this->logger = $logger;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof Patient)
        {
            $this->encryptFields($entity);
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof Patient)
        {
            $this->encryptFields($entity);
        }
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof Patient)
        {
            $this->decryptFields($entity);
        }
    }

    private function encryptFields(Patient $patient)
    {
        // Encrypt the variables
        $nom = Encryptor::encrypt($patient->getNom());

        // Set the entity variables
        $patient->setNom($nom);

        return $patient;
    }

    private function encrypt($value)
    {
        try {
            return Encryptor::encrypt($value);
        } catch(\Throwable $e)
        {
            $this->session->getFlashBag()->add('danger', 'Unable to encrypt field');
            $this->logger->critical(
                'Unable to encrypt field "'.$value.'" in Patient entity. DB update terminated.', array(
                'error' => $e->getMessage(),
            ));
            throw $e;
        }

    }

    private function decryptFields(Patient $patient)
    {
        dd($patient);
        // Decrypt the variables
        $nom = Encryptor::decrypt($patient->getNom());

        // Set the entity variables
        $patient->setNom($nom);
    }

    private function decrypt($id, $fieldName, $value, $key)
    {
        try
        {
            return Encryptor::decrypt($value, $key);
        }
        catch (\Throwable $e)
        {
            $this->session->getFlashBag()->add('warning', 'Unable to decrypt field');
            $this->logger->warning(
                'Unable to decrypt field "'.$fieldName.'" in Patient entity for ID: '.$id, array(
                'error' => $e->getMessage(),
            ));
        }
    }
}