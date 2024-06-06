
#include <iostream>
#include <vector>
#include <malloc.h>
#include <dlfcn.h>
#include <stdio.h>
#include <stdlib.h>
#include <sys/time.h>
#include <sys/resource.h>

static void *liblocal;
static void *(*sysmalloc)(size_t l, size_t ll);
static void (*sysfree)(void *ptr);
static size_t maxram;
static size_t total;

void *malloc(size_t f)
{
  if (!liblocal)
    {
      liblocal = dlopen(NULL, RTLD_NOW);
      sysmalloc = (void*(*)(size_t, size_t))dlsym(liblocal, "calloc");
    }
  if (f + total > maxram)
    return (NULL);
  void *ptr = sysmalloc(1, f);

  if (ptr != NULL)
    total += f;
  return (ptr);

}

void free(void *ptr)
{
  total -= malloc_usable_size(ptr);
  sysfree(ptr);
}

int main(void)
{
  std::vector<double> ptr;
  int i = 0;

  try
    {
      while (1)
	{
	  ptr.push_back(1.2);
	  if (i % 1000)
	    printf("%d\n", i);
	  i = i + 1;
	}
    }
  catch (std::exception &e)
    {
      std::cout << e.what() << std::endl;
    }
  return (0);
}

