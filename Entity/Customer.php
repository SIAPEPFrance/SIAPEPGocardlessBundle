<?php
// src/SIAPEP/GocardlessBundle/Entity/Customer.php
 
namespace SIAPEP\GocardlessBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
 
/**
 * @ORM\Entity(repositoryClass="CustomerRepository")
 * @ORM\Table(name="siapep_gocardless_bundle_customer")
 */

class Customer
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
     * @ORM\Column(name="gc_email", type="string", length=255)
     */
    
    private $gc_email;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_given_name", type="string", length=255)
     */
    
    private $gc_given_name;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_family_name", type="string", length=255)
     */
    
    private $gc_family_name;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_address_line1", type="string", length=255, nullable=true)
     */
    
    private $gc_address_line1;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_city", type="string", length=255, nullable=true)
     */
    
    private $gc_city;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_region", type="string", length=255, nullable=true)
     */
    
    private $gc_region;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_postal_code", type="string", length=255, nullable=true)
     */
    
    private $gc_postal_code;

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

    }

    /**
     * Set id
     *
     * @param string $id
     * @return Customer
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
     * Set local_user
     *
     * @param string $local_user
     * @return Customer
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
     * Set gc_email
     *
     * @param string $gc_email
     * @return Customer
     */
    public function setGcEmail($gc_email)
    {
        $this->gc_email = $gc_email;

        return $this;
    }

    /**
     * Get gc_email
     *
     * @return string 
     */
    public function getGcEmail()
    {
        return $this->gc_email;
    }

    /**
     * Set gc_given_name
     *
     * @param string $gc_given_name
     * @return Customer
     */
    public function setGcGivenName($gc_given_name)
    {
        $this->gc_given_name = $gc_given_name;

        return $this;
    }

    /**
     * Get gc_given_name
     *
     * @return string 
     */
    public function getGcGivenName()
    {
        return $this->gc_given_name;
    }

    /**
     * Set gc_family_name
     *
     * @param string $gc_family_name
     * @return Customer
     */
    public function setGcFamilyName($gc_family_name)
    {
        $this->gc_family_name = $gc_family_name;

        return $this;
    }

    /**
     * Get gc_family_name
     *
     * @return string 
     */
    public function getGcFamilyName()
    {
        return $this->gc_family_name;
    }

    /**
     * Set gc_city
     *
     * @param string $gc_city
     * @return Customer
     */
    public function setGcCity($gc_city)
    {
        $this->gc_city = $gc_city;

        return $this;
    }

    /**
     * Get gc_city
     *
     * @return string 
     */
    public function getGcCity()
    {
        return $this->gc_city;
    }

    /**
     * Set gc_address_line1
     *
     * @param string $gc_address_line1
     * @return Customer
     */
    public function setGcAddressLine1($gc_address_line1)
    {
        $this->gc_address_line1 = $gc_address_line1;

        return $this;
    }

    /**
     * Get gc_address_line1
     *
     * @return string 
     */
    public function getGcAddressLine1()
    {
        return $this->gc_address_line1;
    }

    /**
     * Set gc_region
     *
     * @param string $gc_region
     * @return Customer
     */
    public function setGcRegion($gc_region)
    {
        $this->gc_region = $gc_region;

        return $this;
    }

    /**
     * Get gc_region
     *
     * @return string 
     */
    public function getGcRegion()
    {
        return $this->gc_region;
    }

    /**
     * Set gc_postal_code
     *
     * @param string $gc_postal_code
     * @return Customer
     */
    public function setGcPostalCode($gc_postal_code)
    {
        $this->gc_postal_code = $gc_postal_code;

        return $this;
    }

    /**
     * Get gc_postal_code
     *
     * @return string 
     */
    public function getGcPostalCode()
    {
        return $this->gc_postal_code;
    }

    /**
     * Set created
     *
     * @param string $created
     * @return Customer
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
     * @return Customer
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
     * @return Customer
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