<?php
namespace Xenon;

readonly class FieldName
{
    public string $spaVariable;

    public function __construct(public string $name)
    {
        $this->spaVariable = $this->spaVariable();
    }

    private function spaVariable(): string
    {
        if ($this->name[0] === '$') {
            return $this->name;
        }
        return "store.$this->name";
    }

    public function ssrValue(array $state): string
    {
        foreach (\explode('.', $this->name) as $key) {
            $state = $state[$key];
        }
        return $state;
    }
}
