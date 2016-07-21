<?php
// src/SIAPEP/GocardlessBundle/Entity/CustomerBankAccount.php
 
namespace SIAPEP\GocardlessBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
 
/**
 * @ORM\Entity(repositoryClass="CustomerBankAccountRepository")
 * @ORM\Table(name="siapep_gocardless_bundle_customer_bank_account")
 */

class CustomerBankAccount
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
     * @ORM\Column(name="gc_bank_name", type="string", length=255)
     */
    
    private $gc_bank_name;

    /**
     * @ORM\ManyToOne(targetEntity="SIAPEP\GocardlessBundle\Entity\Customer")
     * @ORM\JoinColumn(name="gc_customer", referencedColumnName="id", nullable=false)
     */
    
    private $gc_customer;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_account_holder_name", type="string", length=255)
     */
    
    private $gc_account_holder_name;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_iban", type="string", length=255)
     */
    
    private $gc_iban;

    /**
     * @var boolean
     *
     * @ORM\Column(name="gc_enabled", type="boolean")
     */
    
    private $gc_enabled;

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

    /**
     * @ORM\ManyToOne(targetEntity="SIAPEP\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="posted_by", referencedColumnName="id", nullable=false)
     */

    private $posted_by;
 
    public function __construct()
    {
        // your own logic
        $this->gc_enabled = true;
    }

    /**
     * Set id
     *
     * @param string $id
     * @return CustomerBankAccount
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
     * Set gc_bank_name
     *
     * @param string $gc_bank_name
     * @return Customer
     */
    public function setGcBankName($gc_bank_name)
    {
        $this->gc_bank_name = $gc_bank_name;

        return $this;
    }

    /**
     * Get gc_bank_name
     *
     * @return string 
     */
    public function getGcBankName()
    {
        return $this->gc_bank_name;
    }

    /**
     * Set local_user
     *
     * @param string $local_user
     * @return CustomerBankAccount
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
     * Set gc_customer
     *
     * @param string $gc_customer
     * @return CustomerBankAccount
     */
    public function setGcCustomer($gc_customer)
    {
        $this->gc_customer = $gc_customer;

        return $this;
    }

    /**
     * Get gc_customer
     *
     * @return string 
     */
    public function getGcCustomer()
    {
        return $this->gc_customer;
    }

    /**
     * Set gc_account_holder_name
     *
     * @param string $gc_account_holder_name
     * @return CustomerBankAccount
     */
    public function setGcAccountHolderName($gc_account_holder_name)
    {
        $this->gc_account_holder_name = $gc_account_holder_name;

        return $this;
    }

    /**
     * Get gc_account_holder_name
     *
     * @return string 
     */
    public function getGcAccountHolderName()
    {
        return $this->gc_account_holder_name;
    }


    /**
     * Set gc_iban
     *
     * @param string $gc_iban
     * @return CustomerBankAccount
     */
    public function setGcIban($gc_iban)
    {
        $this->gc_iban = $gc_iban;

        return $this;
    }

    /**
     * Get gc_iban
     *
     * @return string 
     */
    public function getGcIban()
    {
        return $this->gc_iban;
    }


    /**
     * Set gc_enabled
     *
     * @param boolean $gc_enabled
     * @return CustomerBankAccount
     */
    public function setGcEnabled($gc_enabled)
    {
        $this->gc_enabled = $gc_enabled;

        return $this;
    }

    /**
     * Get gc_enabled
     *
     * @return boolean 
     */
    public function getGcEnabled()
    {
        return $this->gc_enabled;
    }

    /**
     * Set created
     *
     * @param string $created
     * @return CustomerBankAccount
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
     * @return CustomerBankAccount
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
     * @return CustomerBankAccount
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