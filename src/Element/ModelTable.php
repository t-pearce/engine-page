<?php

namespace Engine\Page\Element;

use PtuDex\Models\Model;

class ModelTable extends Table
{
	/** @var Model[] */
	private array $models;

	/** @var Decorator[] */
	private array $decorators = [];
	
	public function render(): string
	{
		if(count($this->models) === 0)
		{
			$this->setElements
			([
				(new Heading())
				->setLevel(2)
				->setContents("No models given")
			]);
		}
		else 
		{
			$this->setElements
			([
				$this->constructHeader(),
				...$this->constructRows()
			]);
		}
		
		return parent::render();
	}

	private function constructHeader(): TableRow
	{
		$model = new \ReflectionClass($this->models[0]);

		$data = [];

		foreach($model->getProperties() as $reflectionProperty)
		{
			$data[] = \Engine\Util\Strings::snakeCaseToHumanReadable($reflectionProperty->getName());
		}

		return TableRow::create()
		->setData($data)
		->setIsHeader();
	}

	/**
	 * @return TableRow[]
	 */
	private function constructRows(): array
	{
		$rows = [];

		foreach($this->models as $model)
		{
			$reflection = new \ReflectionClass($model);

			$data = [];

			foreach($reflection->getProperties() as $reflectionProperty)
			{
				$datum = $reflectionProperty->getValue($model);

				if(in_array($reflectionProperty->getName(), array_keys($this->decorators)))
				{
					$datum = $this->decorators[$reflectionProperty->getName()]
					->setValue($datum)
					->render();
				}

				$data[] = $datum;
			}

			$rows[] = TableRow::create()
			->setData($data);
		}

		return $rows;
	}

	/**
	 * @param Model[] $models
	 */
	public function setModels(array $models) : self
	{
		$this->models = $models;
	
		return $this;
	}

	public function addDecorator(string $propertyName, Decorator $decorator) : self
	{
		$this->decorators[$propertyName] = $decorator;
		$this->scripts = [...$this->scripts, ...$decorator->getScripts()];
		$this->styles  = [...$this->styles, ...$decorator->getStyles()];

		return $this;
	}
}