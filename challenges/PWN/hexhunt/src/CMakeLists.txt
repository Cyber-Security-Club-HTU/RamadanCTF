cmake_minimum_required(VERSION 3.22)
project(hexhunt C)

set(SOURCES "main.c") 

if (CMAKE_BUILD_TYPE STREQUAL "DBG")
    add_compile_options(-Wall -Wextra -ggdb3)
endif()
    add_compile_options(-s)


add_executable(${PROJECT_NAME} ${SOURCES})
target_compile_definitions(${PROJECT_NAME} PRIVATE FLAG="$ENV{THEFLAG}")