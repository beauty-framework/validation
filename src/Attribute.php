<?php

namespace Beauty\Validation;

class Attribute
{

    /** @var array */
    protected array $rules = [];

    /** @var string */
    protected string $key;

    /** @var string|null */
    protected ?string $alias;

    /** @var Validation */
    protected $validation;

    /** @var bool */
    protected bool $required = false;

    /** @var Validation */
    protected $primaryAttribute;

    /** @var array */
    protected array $otherAttributes = [];

    /** @var array */
    protected array $keyIndexes = [];

    /**
     * Constructor
     *
     * @param Validation $validation
     * @param string      $key
     * @param string|null $alias
     * @param array       $rules
     * @return void
     */
    public function __construct(
        Validation $validation,
        string     $key,
        string|null     $alias = null,
        array      $rules = []
    ) {
        $this->validation = $validation;
        $this->alias = $alias;
        $this->key = $key;
        foreach ($rules as $rule) {
            $this->addRule($rule);
        }
    }

    /**
     * Set the primary attribute
     *
     * @param Attribute $primaryAttribute
     * @return void
     */
    public function setPrimaryAttribute(Attribute $primaryAttribute)
    {
        $this->primaryAttribute = $primaryAttribute;
    }

    /**
     * Set key indexes
     *
     * @param array $keyIndexes
     * @return void
     */
    public function setKeyIndexes(array $keyIndexes)
    {
        $this->keyIndexes = $keyIndexes;
    }

    /**
     * Get primary attributes
     *
     * @return Validation|Attribute|null
     */
    public function getPrimaryAttribute(): Validation|Attribute|null
    {
        return $this->primaryAttribute;
    }

    /**
     * Set other attributes
     *
     * @param array $otherAttributes
     * @return void
     */
    public function setOtherAttributes(array $otherAttributes): void
    {
        $this->otherAttributes = [];
        foreach ($otherAttributes as $otherAttribute) {
            $this->addOtherAttribute($otherAttribute);
        }
    }

    /**
     * Add other attributes
     *
     * @param Attribute $otherAttribute
     * @return void
     */
    public function addOtherAttribute(Attribute $otherAttribute): void
    {
        $this->otherAttributes[] = $otherAttribute;
    }

    /**
     * Get other attributes
     *
     * @return array
     */
    public function getOtherAttributes(): array
    {
        return $this->otherAttributes;
    }

    /**
     * Add rule
     *
     * @param Rule $rule
     * @return void
     */
    public function addRule(Rule $rule)
    {
        $rule->setAttribute($this);
        $rule->setValidation($this->validation);
        $this->rules[$rule->getKey()] = $rule;
    }

    /**
     * Get rule
     *
     * @param string $ruleKey
     * @return void
     */
    public function getRule(string $ruleKey)
    {
        return $this->hasRule($ruleKey)? $this->rules[$ruleKey] : null;
    }

    /**
     * Get rules
     *
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * Check the $ruleKey has in the rule
     *
     * @param string $ruleKey
     * @return bool
     */
    public function hasRule(string $ruleKey): bool
    {
        return isset($this->rules[$ruleKey]);
    }

    /**
     * Set required
     *
     * @param boolean $required
     * @return void
     */
    public function setRequired(bool $required)
    {
        $this->required = $required;
    }

    /**
     * Set rule is required
     *
     * @return boolean
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * Get key
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * Get key indexes
     *
     * @return array
     */
    public function getKeyIndexes(): array
    {
        return $this->keyIndexes;
    }

    /**
     * Get value
     *
     * @param string|null $key
     * @return mixed
     */
    public function getValue(string|null $key = null): mixed
    {
        if ($key && $this->isArrayAttribute()) {
            $key = $this->resolveSiblingKey($key);
        }

        if (!$key) {
            $key = $this->getKey();
        }

        return $this->validation->getValue($key);
    }

    /**
     * Get that is array attribute
     *
     * @return boolean
     */
    public function isArrayAttribute(): bool
    {
        return count($this->getKeyIndexes()) > 0;
    }

    /**
     * Check this attribute is using dot notation
     *
     * @return boolean
     */
    public function isUsingDotNotation(): bool
    {
        return strpos($this->getKey(), '.') !== false;
    }

    /**
     * Resolve sibling key
     *
     * @param string $key
     * @return string
     */
    public function resolveSiblingKey(string $key): string
    {
        $indexes = $this->getKeyIndexes();
        $keys = explode("*", $key);
        $countAsterisks = count($keys) - 1;
        if (count($indexes) < $countAsterisks) {
            $indexes = array_merge($indexes, array_fill(0, $countAsterisks - count($indexes), "*"));
        }
        $args = array_merge([str_replace("*", "%s", $key)], $indexes);
        return call_user_func_array('sprintf', $args);
    }

    /**
     * Get humanize key
     *
     * @return string
     */
    public function getHumanizedKey()
    {
        $primaryAttribute = $this->getPrimaryAttribute();
        $key = str_replace('_', ' ', $this->key);

        // Resolve key from array validation
        if ($primaryAttribute) {
            $split = explode('.', $key);
            $key = implode(' ', array_map(function ($word) {
                if (is_numeric($word)) {
                    $word = $word + 1;
                }
                return Helper::snakeCase($word, ' ');
            }, $split));
        }

        return ucfirst($key);
    }

    /**
     * Set alias
     *
     * @param string $alias
     * @return void
     */
    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }

    /**
     * Get alias
     *
     * @return string|null
     */
    public function getAlias(): string|null
    {
        return $this->alias;
    }
}
