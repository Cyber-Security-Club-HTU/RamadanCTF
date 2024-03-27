cmake_minimum_required(VERSION 3.18)
project(stack-attack C)

set(SOURCES "main.c") 

set(CMAKE_C_FLAGS "-m32")
set(CMAKE_C_FLAGS "${CMAKE_C_FLAGS} -fno-stack-protector  -no-pie")
set(CMAKE_C_FLAGS_DEBUG "${CMAKE_C_FLAGS_DEBUG} -O0")


if (CMAKE_BUILD_TYPE STREQUAL "DBG")
    add_compile_options(-Wall -Wextra -ggdb3)
endif()
    add_compile_options(-s)

add_definitions(-DFLAG="$ENV{FLAG}")

add_executable(${PROJECT_NAME} ${SOURCES})