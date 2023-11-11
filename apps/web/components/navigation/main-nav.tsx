"use client"

import * as React from "react";
import Link from "next/link";
import { cn } from "@/lib/utils";
import { Icons } from "../ui/icons";
import { NavigationItem } from "@/types";
import { MobileNav } from "@/components/navigation/mobile-nav";
import { NavigationConfig } from "@/config/navigation";
import {
  NavigationMenu,
  NavigationMenuContent,
  NavigationMenuItem,
  NavigationMenuLink,
  NavigationMenuList,
  NavigationMenuTrigger,
  navigationMenuTriggerStyle,
} from "@/components/ui/navigation-menu";



// Define the props interface for the MainNav component
interface MainNavProps {
  items?: NavigationItem[];
  children?: React.ReactNode;
}

// MainNav component responsible for rendering the navigation menu
export function MainNav({ items, children }: MainNavProps) {

  // Initialize state to manage the visibility of the mobile menu
  const [showMobileMenu, setShowMobileMenu] = React.useState<boolean>(false);

  return (
    <React.Fragment>
      <section className="flex gap-6 md:gap-10">
        {/* Render the site logo and name */}
        <Link href="/" className="hidden items-center space-x-2 md:flex"> 
          <Icons.logo />
          <span className="hidden font-bold sm:inline-block">
            {'Skylark'}
          </span>
        </Link>

        {/* Desktop navigation menu */}
        <NavigationMenu className="hidden md:block">
          <NavigationMenuList>
            <NavigationMenuItem>  
              <NavigationMenuTrigger>Getting Started</NavigationMenuTrigger>
              <NavigationMenuContent>

                {/* Render a list of navigation items */}
                <ul className="grid gap-3 p-6 md:w-[400px] lg:w-[500px] lg:grid-cols-[.75fr_1fr]">

                  {/* Render a special ListItem component for each navigation item */}
                  <li className="row-span-3">
                    <NavigationMenuLink asChild>

                      {/* Render content for the navigation item */}
                      <a
                        className="flex h-full w-full select-none flex-col justify-end rounded-md bg-gradient-to-b from-muted/50 to-muted p-6 no-underline outline-none focus:shadow-md"
                        href="/"
                      >
                        {/* Render the logo, title, and description */}
                        <Icons.logo className="h-6 w-6" />
                        <div className="mb-2 mt-4 text-lg font-medium">
                          Skylark
                        </div>
                        <p className="text-sm leading-tight text-muted-foreground">
                          Accusantium alias hic quidem tempore eaque. Autem dolorem magni unique.
                        </p>
                      </a>
                    </NavigationMenuLink>
                  </li>
                  {NavigationConfig.NavItem.slice(0, 3).map((component) => (
                    <ListItem key={component.title} title={component.title} href={component.href} >
                      {component.description}
                    </ListItem>
                  ))}
                </ul>
              </NavigationMenuContent>
            </NavigationMenuItem>
                  
            {/* Render content for the Organization navigation item */}
            <NavigationMenuItem>
              <NavigationMenuTrigger>Organization</NavigationMenuTrigger>
              <NavigationMenuContent>
                <ul className="grid w-[400px] gap-3 p-4 md:w-[500px] md:grid-cols-2 lg:w-[600px] ">
                  {NavigationConfig.NavItem.slice(3).map((component) => (
                    <ListItem key={component.title} title={component.title} href={component.href} >
                      {component.description}
                    </ListItem>
                  ))}
                </ul>
              </NavigationMenuContent>
            </NavigationMenuItem>

            {/* Render Pricing Button */}
            <NavigationMenuItem>
              <Link href="/pricing" legacyBehavior passHref>
                <NavigationMenuLink className={navigationMenuTriggerStyle()}>
                  Pricing
                </NavigationMenuLink>
              </Link>
            </NavigationMenuItem>
          </NavigationMenuList>
        </NavigationMenu>

        <button
          className="flex items-center space-x-2 md:hidden"
          onClick={() => setShowMobileMenu(!showMobileMenu)}
        >
          {showMobileMenu ? <Icons.close /> : <Icons.logo />}
          <span className="font-bold">Menu</span>
        </button>
        {showMobileMenu && items && <MobileNav items={items}>{children}</MobileNav>}
      </section>
    </React.Fragment>
  );
}



// Define a ListItem component using React.forwardRef
const ListItem = React.forwardRef< React.ElementRef<"a">, React.ComponentPropsWithoutRef<"a">>((props, ref) => {

  // Destructure props to get className, title, and children
  const { className, title, children } = props;

  // Render the ListItem content
  return (
    <li>
      <NavigationMenuLink asChild>
        <a
          ref={ref}
          className={cn(
            // Apply CSS classes using cn utility
            "block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground",
            className
          )}
          {...props} // Spread remaining props to the anchor element
        >
          <div className="text-sm font-medium leading-none">{title}</div>
          <p className="line-clamp-2 text-sm leading-snug text-muted-foreground">
            {children} {/* Render the children passed to ListItem */}
          </p>
        </a>
      </NavigationMenuLink>
    </li>
  );
});

// Set a displayName for debugging and development purposes
ListItem.displayName = "ListItem"; 