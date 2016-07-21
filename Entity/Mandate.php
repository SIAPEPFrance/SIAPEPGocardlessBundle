<?php
// src/SIAPEP/GocardlessBundle/Entity/Mandate.php
 
namespace SIAPEP\GocardlessBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
 
/**
 * @ORM\Entity(repositoryClass="MandateRepository")
 * @ORM\Table(name="siapep_gocardless_bundle_mandate")
 */

class Mandate
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\generatedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_id", type="string", length=255)
     */
    
    private $gc_id;

    /**
     * @ORM\ManyToOne(targetEntity="SIAPEP\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="local_user", referencedColumnName="id", nullable=false)
     */
    
    private $local_user;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_reference", type="string", length=255)
     */
    
    private $gc_reference;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_scheme", type="string", length=255)
     */
    
    private $gc_scheme;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_status", type="string", length=255)
     */
    
    private $gc_status;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_pdf_path", type="string", length=255, nullable=true)
     */
    
    private $gc_pdf_path;

    /**
     * @ORM\ManyToOne(targetEntity="SIAPEP\GocardlessBundle\Entity\CustomerBankAccount")
     * @ORM\JoinColumn(name="gc_customer_bank_account", referencedColumnName="id", nullable=false)
     */
    
    private $gc_customer_bank_account;

    /**
     * @ORM\ManyToOne(targetEntity="SIAPEP\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="posted_by", referencedColumnName="id", nullable=false)
     */

    private $posted_by;

    /**
     * @var string
     *
     * @ORM\Column(name="posted_from", type="string")
     */
    
    private $posted_from;

    /**
     * @var datetime
     *
     * @ORM\Column(type="datetime")
     */
    
    private $created;

    /**
     * @var datetime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    
    private $updated;
 

    public function __construct()
    {
        // your own logic
        $this->created = new \Datetime();
        $this->posted_from = 'back_office';

    }

    /**
     * Set id
     *
     * @param string $id
     * @return Mandate
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set gc_id
     *
     * @param string $gc_id
     * @return Customer
     */
    public function setGcId($gc_id)
    {
        $this->gc_id = $gc_id;

        return $this;
    }

    /**
     * Get gc_id
     *
     * @return string 
     */
    public function getGcId()
    {
        return $this->gc_id;
    }

    /**
     * Set local_user
     *
     * @param string $local_user
     * @return Mandate
     */
    public function setLocalUser($local_user)
    {
        $this->local_user = $local_user;

        return $this;
    }

    /**
     * Get local_user
     *
     * @return string 
     */
    public function getLocalUser()
    {
        return $this->local_user;
    }

    /**
     * Set gc_reference
     *
     * @param string $gc_reference
     * @return Mandate
     */
    public function setGcReference($gc_reference)
    {
        $this->gc_reference = $gc_reference;

        return $this;
    }

    /**
     * Get gc_reference
     *
     * @return string 
     */
    public function getGcReference()
    {
        return $this->gc_reference;
    }

    /**
     * Set gc_scheme
     *
     * @param string $gc_scheme
     * @return Mandate
     */
    public function setGcScheme($gc_scheme)
    {
        $this->gc_scheme = $gc_scheme;

        return $this;
    }

    /**
     * Get gc_scheme
     *
     * @return string 
     */
    public function getGcScheme()
    {
        return $this->gc_scheme;
    }


    /**
     * Set gc_status
     *
     * @param string $gc_status
     * @return Mandate
     */
    public function setGcStatus($gc_status)
    {
        $this->gc_status = $gc_status;

        return $this;
    }

    /**
     * Get gc_iban
     *
     * @return string 
     */
    public function getGcStatus()
    {
        return $this->gc_status;
    }

    /**
     * Set gc_pdf_path
     *
     * @param string $gc_pdf_path
     * @return Mandate
     */
    public function setGcPdfPath($gc_pdf_path)
    {
        $this->gc_pdf_path = $gc_pdf_path;

        return $this;
    }

    /**
     * Get gc_pdf_path
     *
     * @return string 
     */
    public function getGcPdfPath()
    {
        return $this->gc_pdf_path;
    }

    /**
     * Set gc_customer_bank_account
     *
     * @param string $gc_customer_bank_account
     * @return Mandate
     */
    public function setGcCustomerBankAccount($gc_customer_bank_account)
    {
        $this->gc_customer_bank_account = $gc_customer_bank_account;

        return $this;
    }

    /**
     * Get gc_customer_bank_account
     *
     * @return string 
     */
    public function getGcCustomerBankAccount()
    {
        return $this->gc_customer_bank_account;
    }

    /**
     * Set created
     *
     * @param string $created
     * @return Mandate
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set created
     *
     * @param string $created
     * @return Mandate
     */
    public function setUpdated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getUpdated()
    {
        return $this->created;
    }
    /**
     * Set posted_by
     *
     * @param string $posted_by
     * @return Mandate
     */
    public function setPostedBy($posted_by)
    {
        $this->posted_by = $posted_by;

        return $this;
    }

    /**
     * Get posted_by
     *
     * @return string 
     */
    public function getPostedBy()
    {
        return $this->posted_by;
    }

}