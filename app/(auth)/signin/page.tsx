"use client";

import React from "react";
import Link from "next/link"
import { buttonVariants } from "@/components/ui/button"
import { cn } from "@/lib/utils"
import { Icons } from "@/components/icons"

import { SignIn } from '@clerk/nextjs';

const SignInPage = () => {
  return (
    <React.Fragment>
      <div className="container max-w-[74rem] flex h-screen w-screen flex-col items-center justify-center">
      <Link
        href="/"
        className={cn(
          buttonVariants({ variant: "ghost" }),
          "absolute left-4 top-4 md:left-8 md:top-8"
        )}
      >
        <>
          <Icons.chevronLeft className="mr-2 h-4 w-4" />
          Back
        </>
      </Link>
 
      <SignIn />
  
      </div>
    </React.Fragment>
  );
};

export default SignInPage;