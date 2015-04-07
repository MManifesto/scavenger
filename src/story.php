<?php
/**
 * @Entity @Table(name="story")
 */
class Story
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
    protected $name;
    /**
     * @Column(type="string")
     * @var string
     */
    protected $description;

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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @OneToMany(targetEntity="Hunt", mappedBy="story")
     * @var hunts[]
     **/
    protected $hunts = null;

    public function __construct()
    {
        $this->hunts = new ArrayCollection();
    }

    public function addHunt($hint)
    {
        $this->hunts[] = $hunt;
    }
}