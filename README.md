# array-manipulator

Cygnite Array Manipulator component used for simple array manipulation and reading array value using simple
string path.

#Installation

Array Manipulator uses Composer for installation. For installing composer documentation, please refer to getcomposer.org.
Add following into your composer.json.

    "cygnite/array-manipulator" : "1.*"

#Usage

Cygnite array accessor used to read values from multi multidimensional array. It helps when you want to beautify
your syntax and easy to access values. You can read values as below.

#Example

    $array = [
             'profile' => [
                 "experience"  => [
                     "field" => "Web Development",
                     "technology"    => "PHP"
                 ]
             ]
         ];
    $arrayAccessor = (new ArrayAccessor())->set($array);
    echo $arrayAccessor->toString('profile.experience.field'); // output: Web Development


In some cases your array key may contains dot(.) which will make system confused whether it should look for next
key or same. In such cases while getting value you need to provide key as underscore or dash prefix as below.

    $array2 = [
             'profile' => [
                 "experience"  => [
                     "technology.version"  => "Welcome to PHP v5.4"
                 ]
             ]
         ];
    $arrayAccessor = (new ArrayAccessor())->set($array1);
    echo $arrayAccessor->toString('profile.experience.technology_version'); // output: Welcome to PHP v5.4


#Getting default value if array element not exists

    $array3 = [
             'profile' => [
                 "experience"  => '4 Years'
             ]
         ];
    $arrayAccessor = (new ArrayAccessor())->set($array3);
    echo $arrayAccessor->toString('profile.experience.area', 'Application Development'); // output 5 years


# Using Closure Syntax

    $array4 = [
             'profile' => [
                 "author"  => 'Sanjoy Dey'
             ]
         ];
    $arrayAccessor = ArrayAccessor::make(function($a) use ($array4)
    {
        return $a->set($array4);
    });
    echo $arrayAccessor->toString('profile.author');

