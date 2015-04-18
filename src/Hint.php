<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity @Table(name="hint")
 */
class Hint implements JsonSerializable
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
    protected $value;
    /**
     * @ManyToOne(targetEntity="Clue", inversedBy="hints")
     **/
    protected $clue;
    /**
     * @Column(type="integer")
     * @var int
     */
    protected $priority = 5;
    /**
     * @Column(type="integer")
     * @var int
     */
    protected $usesLifeline = 1;


    public function getId()
    {
        return $this->id;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    public function getUsesLifeline()
    {
        return $this->usesLifeline;
    }

    public function setUsesLifeline($usesLifeline)
    {
        $this->usesLifeline = $usesLifeline;
    }

    public function getClue()
    {
        return $this->clue;
    }

    public function getClueID()
    {
        $id = -1;

        if ($this->clue != null)
        {
            $id = $this->clue->getId();
        }

        return $id;
    }

    public function setClue($clue)
    {
        $this->clue = $clue;
    }

    public function __toString()
    {
        return strval($this->id);
    }

    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'value'=> $this->value,
            'clueID' => $this->getClueID()
        );
    }
}
