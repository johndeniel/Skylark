"use client";

import React from "react";
import Link from "next/link";
import { cn } from "@/lib/utils";
import { buttonVariants } from "@/components/ui/button";
import LatestUpdate from "@/components/latest-update";
import { siteConfig } from "@/config/site";
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
            href={siteConfig.links.portal}
            className="rounded-2xl bg-muted px-4 py-1.5 text-sm font-medium"
            target="_blank"
          >
            BulSU Portal
          </Link>
          {/* Main title */}
          <h1 className="font-heading text-3xl sm:text-5xl md:text-6xl lg:text-7xl">
            Bulacan State University Meneses Campus
          </h1>
          {/* Description */}
          <p className="max-w-[42rem] leading-normal text-muted-foreground sm:text-xl sm:leading-8">
            I&apos;m building a web app with Next.js 13 and open sourcing
            everything. Follow along as we figure this out together.
          </p>
          {/* Buttons */}
          <div className="space-x-4">
            <Link href={!isLoaded || !userId ? "/sign-in" : "/dashboard"} className={cn(buttonVariants({ size: "lg" }))}>
              Get Started
            </Link>
            <Link
              href={siteConfig.links.github}
              target="_blank"
              rel="noreferrer"
              className={cn(buttonVariants({ variant: "outline", size: "lg" }))}
            >
              GitHub
            </Link>
          </div>
        </div>
      </section>

      {/* Latest Updates section */}
      <section className="container max-w-[74rem] space-y-6 py-8 md:py-12 lg:py-24">
        <div className="mx-auto flex max-w-[58rem] flex-col items-center space-y-4 text-center">
          {/* Section title */}
          <h2 className="font-heading text-3xl leading-[1.1] sm:text-3xl md:text-6xl">
            Latest Updates
          </h2>
        </div>
        {/* Display the latest update component */}
        <LatestUpdate className="py-8" />
      </section>
    </React.Fragment>
  );
}