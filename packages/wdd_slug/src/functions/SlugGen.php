<?php
namespace wdd\slug\functions;

class SlugGen
{
    /**
     * Generate a URL-friendly slug from a given string.
     *
     * @param string $text The input text.
     * @param string $separator The separator to use (default is '-').
     * @param int|null $maxLength Maximum length of slug (default is null for no limit).
     * @return string The generated slug.
     */
    public function generate(string $text, string $separator = '-', int $maxLength = null): string
    {
        // 1. transfer letters to Small Letters
        $slug = mb_strtolower($text, 'UTF-8');

        // 2. delete the unnecessary letters
        $slug = preg_replace('/[^\p{L}\p{N}]+/u', $separator, $slug);

        // 3. delete the plus separators from the start and the end
        $slug = trim($slug, $separator);

        // 4. determine the maxlength if exists
        if ($maxLength !== null) {
            $slug = mb_substr($slug, 0, $maxLength, 'UTF-8');
        }

        return $slug;
    }
}
