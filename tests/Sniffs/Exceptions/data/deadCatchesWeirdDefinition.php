<?php // lint >= 7.1

try {

} catch (\Throwable$e) {

}

try {

} catch (\Throwable$e) {

} catch (\Exception$e) {

}

try {

} catch (\Throwable$e) {

} catch (\FooException|\Exception$e) {

}
