# fat-behive
I focused on the part of the code that controls the filtering of books by genre. 
The key update was adding 'field' => 'slug' in the tax_query array in lines 7. This ensures that WordPress knows it should be filtering by the term slug (i.e., science-fiction). Without this, the filtering might not have worked as expected.
