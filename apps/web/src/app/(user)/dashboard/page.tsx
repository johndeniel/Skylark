"use client";

import React from "react";
import { redirect } from "next/navigation";
import { useAuth } from "@clerk/nextjs";

export default function Dashboard () {

    const { isLoaded, userId} = useAuth();
    if (!isLoaded || !userId) redirect("/sign-in");

    return (
        <React.Fragment>
        <h1>Welcome to the Dashboard Page!</h1>
        {/* Add any content or components specific to the Profile page here */}
        </React.Fragment>
    );
};