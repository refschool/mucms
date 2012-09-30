<?php
$sql = "SELECT * FROM `$tprefix"."_category` ORDER BY `cat_id`";//echo $sql;

$nav_query = $db->query($sql);
echo $db->error;

$tree = "";                         // Clear the directory tree
$depth = 1;                         // Child level depth.
$top_level_on = 1;               // What top-level category are we on?
$exclude = ARRAY();               // Define the exclusion array
ARRAY_PUSH($exclude, 0);     // Put a starting value in it
//$tempTree = '';
//script principal
WHILE ( $nav_row = $nav_query->fetch_array() )
{
     $goOn = 1;               // Resets variable to allow us to continue building out the tree.
     FOR($x = 0; $x < COUNT($exclude); $x++ )          // Check to see if the new item has been used
     {
          IF ( $exclude[$x] == $nav_row['cat_id'] )
          {
               $goOn = 0;
               BREAK;                    // Stop looking b/c we already found that it's in the exclusion list and we can't continue to process this node
          }
     }
     IF ( $goOn == 1 )
     {
          $tree .= '<input type="checkbox" name="category[]" value="'.$nav_row['cat_id'].'"  '.check_category($editid,$nav_row['cat_id']).'/>'.$nav_row['cat_label'].'<br>';      // Process the main tree node
          ARRAY_PUSH($exclude, $nav_row['cat_id']);          // Add to the exclusion list
          IF ( $nav_row['cat_id'] < 6 )
          { $top_level_on = $nav_row['cat_id']; }
 
          $tree .= build_child($nav_row['cat_id']);          // Start the recursive function of building the child tree
     }
}

// Recursive function to get all of the children...unlimited depth
function build_child($oldID) {
	// Refer to the global array defined at the top of this script
     global $exclude, $depth, $db,$tprefix,$editid; 
	$tempTree = '';
	 
	 
	 $child_sql = "SELECT * FROM `$tprefix"."_category` WHERE parent_id=" . $oldID ; //echo $child_sql ;
     $child_query = $db->query($child_sql);
     WHILE ( $child = $child_query->fetch_array() )
     {
          IF ( $child['cat_id'] != $child['parent_id'] )
          {
               FOR ( $c=0;$c<$depth;$c++ )               // Indent over so that there is distinction between levels
               { $tempTree .= "&nbsp;"; }
               $tempTree .= "- " . '<input type="checkbox" name="category[]" value="'.$child['cat_id'].'" '.check_category($editid,$child['cat_id']).' />'.$child['cat_label'].'<br>';
               $depth++;          // Incriment depth b/c we're building this child's child tree  (complicated yet???)
               $tempTree .= build_child($child['cat_id']);          // Add to the temporary local tree
               $depth--;          // Decrement depth b/c we're done building the child's child tree.
               ARRAY_PUSH($exclude, $child['cat_id']);               // Add the item to the exclusion list
          }
     }
 
     return $tempTree;          // Return the entire child tree
}

echo $tree;