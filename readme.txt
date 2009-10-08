CSS PARSER
==========

General purpose CSS parser, work in progress. Parses CSS into an array and glues it back together.



USAGE
-----

1) Include the library: include('parser.php');

2) Create a new parser object: $parser = new CssParser();

3) Load some css from a string... $parser->load_string('#foo { color:red; }');
   ... from a file...  $parser->load_file('style.css');
   ... or from multiple files at once...  $parser->load_file('reset.css;layout.css;skin.css');

4) $parser->parse();

5) Modify the array $parser->parsed and modify it as you like

6) use $parser->glue(); to turn the array back into css code