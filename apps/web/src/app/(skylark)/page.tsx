"use client";

import React from "react";
import Link from "next/link";
import { cn } from "../../lib/utils";
import { buttonVariants } from "../../components/ui/button";
import { siteConfig } from "../../config/skylark";
import { useAuth } from "@clerk/nextjs";


// Home component to render the main page content
export default function Meneses() {
  const { isLoaded, userId} = useAuth();
  return (
    <React.Fragment>
      {/* Introduction section */}
      <section className="space-y-6 pb-8 pt-6 md:pb-12 md:pt-10 lg:py-32">
        <div className="container flex max-w-[64rem] flex-col items-center gap-4 text-center">
          {/* Link to the BulSU Portal */}
          <Link
            href={siteConfig.links.github}
            className="rounded-2xl bg-muted px-4 py-1.5 text-sm font-medium"
            target="_blank"
          >
            GitHub
          </Link>
          {/* Main title */}
          <h1 className="font-heading text-3xl sm:text-5xl md:text-6xl lg:text-7xl">
            Skylark
          </h1>
          {/* Description */}
          <p className="max-w-[42rem] leading-normal text-muted-foreground sm:text-xl sm:leading-8">
            Improve application performance and enhance its reliability by thoroughly investigating, securely storing, and meticulously analyzing logs
          </p>
          {/* Buttons */}
          <div className="space-x-4">
            <Link href={!isLoaded || !userId ? "/sign-in" : "/dashboard"} className={cn(buttonVariants({ size: "lg" }))}>
              Get Started
            </Link>
            <Link
              href={siteConfig.links.docs}
              target="_blank"
              rel="noreferrer"
              className={cn(buttonVariants({ variant: "outline", size: "lg" }))}
            >
              Docs
            </Link>
          </div>
        </div>
      </section>
    </React.Fragment>
  );
}