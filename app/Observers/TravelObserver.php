<?php

namespace App\Observers;

use App\Models\Travel;
use Illuminate\Support\Str;
class TravelObserver
{
    public function creating(Travel $travel): void
    {
        // Automatically generate the slug from the name
        $originalSlug = Str::slug($travel->name);

        // Check if the slug already exists and modify it if needed
        $travel->slug = $this->generateUniqueSlug($originalSlug);
    }

    /**
     * Generate a unique slug.
     *
     * @param string $slug
     * @return string
     */
    private function generateUniqueSlug(string $slug): string
    {
        // Initialize slug to check for uniqueness
        $uniqueSlug = $slug;
        $count = 1;

        // Check if a travel record with this slug already exists
        while (Travel::where('slug', $uniqueSlug)->exists()) {
            // Append a number to the slug if it already exists
            $uniqueSlug = $slug . '-' . $count;
            $count++;
        }

        return $uniqueSlug;
    }
}