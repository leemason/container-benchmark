# container-benchmark

Simple benchmark of the container vs other popular containers. Ive only included League\Container as this container is highly inspired by this and laravel.

A good benchmark of league container against others can be found here:

These are the stats (not a full testbench at all, just a quick test to ensure its working).

Difference during basic location (by registering either the class AND its arguments, all by registering a closure AND its arguments to return the instance).

{
    "time": "80.84%",
    "memory": "29.84%",
    "peak_memory": "67.90%"
}

As you can see the container is much more performant in memory usage and is about 20% faster too.



Difference during reflection based location (the classes arent registered in the container, the container needs to find the arguments through reflection and build the service that way).

{
    "time": "80.59%",
    "memory": "138.41%",
    "peak_memory": "71.28%"
}

This is an interesting test which shows some unexpected results. As usual the container is around 20% faster. But the memory usage is slightly higher.

I think this is down to the fact the reflection events things up a bit and somehow the optimisations done effect this as well, but as the container is still 20% faster i haven't looked too much into it.
