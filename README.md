# PHPStan Custom Rules library

Here you can find custom rules for PHPStan in WP Media Context.

## Purpose

This repository contains custom rules for PHPStan to be used in the WP Media context. The goal is to extend PHPStan's set of rules with our own custom rules, allowing us to enforce specific coding standards and practices in our projects.

## Usage

To use the custom rules in this repository, you need to add it as a dependency in your project using Composer. Then, you can configure PHPStan to use the custom rules by adding them to your `phpstan.neon` configuration file.

## Adding Custom Rules

To add a new custom rule to this repository, follow these steps:

1. Create a new PHP file for your custom rule in the `src/Rules` directory.
2. Implement the custom rule by extending the appropriate PHPStan rule class and implementing the required methods.
3. Add a test for your custom rule in the `tests/Rules` directory.
4. Update the `composer.json` file to include the new custom rule in the autoload section.
5. Run the tests to ensure your custom rule works as expected.
