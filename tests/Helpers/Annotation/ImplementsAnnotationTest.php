<?php declare(strict_types = 1);

namespace SlevomatCodingStandard\Helpers\Annotation;

use InvalidArgumentException;
use LogicException;
use PHPStan\PhpDocParser\Ast\PhpDoc\ImplementsTagValueNode;
use PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use SlevomatCodingStandard\Helpers\TestCase;

class ImplementsAnnotationTest extends TestCase
{

	public function testAnnotation(): void
	{
		$annotation = new ImplementsAnnotation(
			'@implements',
			1,
			10,
			'Description',
			new ImplementsTagValueNode(
				new GenericTypeNode(new IdentifierTypeNode('Whatever'), [new IdentifierTypeNode('Anything')]),
				'Description'
			)
		);

		self::assertSame('@implements', $annotation->getName());
		self::assertSame(1, $annotation->getStartPointer());
		self::assertSame(10, $annotation->getEndPointer());
		self::assertSame('Description', $annotation->getContent());

		self::assertFalse($annotation->isInvalid());
		self::assertTrue($annotation->hasDescription());
		self::assertSame('Description', $annotation->getDescription());
		self::assertSame('@implements Whatever<Anything> Description', $annotation->export());
	}

	public function testUnsupportedAnnotation(): void
	{
		self::expectException(InvalidArgumentException::class);
		self::expectExceptionMessage('Unsupported annotation @param.');
		new ImplementsAnnotation('@param', 1, 1, null, null);
	}

	public function testGetContentNodeWhenInvalid(): void
	{
		self::expectException(LogicException::class);
		self::expectExceptionMessage('Invalid @implements annotation.');
		$annotation = new ImplementsAnnotation('@implements', 1, 1, null, null);
		$annotation->getContentNode();
	}

	public function testGetDescriptionWhenInvalid(): void
	{
		self::expectException(LogicException::class);
		self::expectExceptionMessage('Invalid @implements annotation.');
		$annotation = new ImplementsAnnotation('@implements', 1, 1, null, null);
		$annotation->getDescription();
	}

	public function testGetTypeWhenInvalid(): void
	{
		self::expectException(LogicException::class);
		self::expectExceptionMessage('Invalid @implements annotation.');
		$annotation = new ImplementsAnnotation('@implements', 1, 1, null, null);
		$annotation->getType();
	}

}
