<?php

/**
 * Set return type of wpm_apply_filters_typed() based on its optional preceding docblock.
 */

declare(strict_types=1);

namespace WPMedia\PHPStan\Rules\ApplyFiltersTyped;

use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\FunctionReflection;
use PHPStan\Type\MixedType;
use PHPStan\Type\Type;
use SzepeViktor\PHPStan\WordPress\HookDocBlock;

class ApplyFiltersTypedDynamicFunctionReturnTypeExtension implements \PHPStan\Type\DynamicFunctionReturnTypeExtension {
	/** @var \SzepeViktor\PHPStan\WordPress\HookDocBlock */
	protected $hookDocBlock;

	public function __construct(HookDocBlock $hookDocBlock) {
		$this->hookDocBlock = $hookDocBlock;
	}

	public function isFunctionSupported(FunctionReflection $functionReflection): bool {
		return in_array(
			$functionReflection->getName(),
			[
				'wpm_apply_filters_typed',
				'wpm_apply_filters_typesafe',
			],
			true
		);
	}

	/**
	 * @see https://developer.wordpress.org/reference/functions/apply_filters/
	 * @see https://developer.wordpress.org/reference/functions/apply_filters_deprecated/
	 * @see https://developer.wordpress.org/reference/functions/apply_filters_ref_array/
	 *
	 * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
	 */
	public function getTypeFromFunctionCall(FunctionReflection $functionReflection, FuncCall $functionCall, Scope $scope): Type {
		$default = new MixedType();
		$resolvedPhpDoc = $this->hookDocBlock->getNullableHookDocBlock( $functionCall, $scope );

		if ( null === $resolvedPhpDoc ) {
			return $default;
		}

		// Fetch the `@param` values from the docblock.
		$params = $resolvedPhpDoc->getParamTags();

		foreach ( $params as $param ) {
			return $param->getType();
		}

		return $default;
	}
}