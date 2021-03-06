<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity @Table(name="party")
 */
class Party implements JsonSerializable
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $name = "";

    /**
     * @Column(type="integer")    
     * @var string
     */
    protected $state=1;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @OneToMany(targetEntity="User", mappedBy="party")
     * @var users[]
     */
    protected $users = null;

    /**
     * @OneToMany(targetEntity="Hunt", mappedBy="party")
     * @var hunts[]
     */
    protected $hunts = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->hunts = new ArrayCollection();
    }

    public function addHunt($hunt)
    {
        $this->hunts[] = $hunt;
    }

    public function addUser($user)
    {
        $this->users[] = $user;
    }

    public function getHunts()
    {
        return $this->hunts;
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function jsonSerialize()
    {
        $users_json = "";
        foreach ($this->users as $user) {
            if ($user->getState() == 1)
            {
                $users_json[$user->getId()] = $user->jsonSerializeShallow();
            }
        }

        return array(
            'id' => $this->id,
            'name' => $this->name,
            'users' => $users_json
        );
    }
}
