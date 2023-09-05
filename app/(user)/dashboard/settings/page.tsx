import Link from "next/link"

import { cn } from "@/lib/utils"
import { Alert, AlertDescription, AlertTitle } from "@/components/ui/alert"
import { AppearanceForm } from "@/components/appearance-form"
import { buttonVariants } from "@/components/ui/button"
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from "@/components/ui/card"
import { Separator } from "@/components/ui/separator"
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs"
import { Header } from "@/components/header"
import { Shell } from "@/components/shell"

export const metadata = {
  title: "Settings",
  description: "Manage account and website settings.",
}

export default async function SettingsPage() {
  return (
    <Shell className="gap-4">
      <Header
        title="Settings"
        description="Manage account and website settings."
        size="sm"
      />
      <Separator />
      <Tabs defaultValue="account" className="hidden w-full md:block">
        <TabsList className="grid w-full grid-cols-3">
          <TabsTrigger value="account">Account</TabsTrigger>
          <TabsTrigger value="appearance">Appearance</TabsTrigger>
          <TabsTrigger value="reminder">Reminder</TabsTrigger>
        </TabsList>
        <TabsContent value="account">
          <Card>
            <CardHeader>
              <CardTitle>Account</CardTitle>
              <CardDescription>
                Make changes to your account here. Click save when you&apos;re
                done.
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-10">
        
              <div>
                <p className="font-semibold">Profile</p>
                <div className="space-y-8">
                  <p className="text-muted-foreground">
                    Manage your profile information with clerk
                  </p>
                  <Link
                    href="/journal/settings/user-profile"
                    className={cn(buttonVariants())}
                  >
                    Manage Profile
                  </Link>
                </div>
              </div>
            </CardContent>
          </Card>
        </TabsContent>


         <TabsContent value="appearance">
          <Card>
            <CardHeader>
              <CardTitle>Appearance</CardTitle>
              <CardDescription>
                Customize the appearance of the app. Automatically switch
                between day and night themes.
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-10">
              <AppearanceForm />
            </CardContent>
          </Card>
        </TabsContent>


        <TabsContent value="reminder">
          <Card>
            <CardHeader>
              <CardTitle>Reminder</CardTitle>
              <CardDescription>
                Customize the reminder frequency you are comfortable with.
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-10">
          
            </CardContent>
            <CardFooter>
              We&apos;ll send you a reminder email every day/weekly at 9:00 Pm
              UTC
            </CardFooter>
          </Card>
        </TabsContent>
      </Tabs>
      <div className="space-y-10 md:hidden">
        <Card>
          <CardHeader>
            <CardTitle>Account</CardTitle>
            <CardDescription>
              Make changes to your account here. Click save when you&apos;re
              done.
            </CardDescription>
          </CardHeader>
          <CardContent className="space-y-10">
           
            <div>
              <p className="font-semibold">Profile</p>
              <div className="space-y-8">
                <p className="text-muted-foreground">
                  Manage your profile information with clerk
                </p>
                <Link
                  href="/journal/settings/user-profile"
                  className={cn(buttonVariants())}
                >
                  Manage Profile
                </Link>
              </div>
            </div>
          </CardContent>
        </Card>
        <Card>
          <CardHeader>
            <CardTitle>Appearance</CardTitle>
            <CardDescription>
              Customize the appearance of the app. Automatically switch between
              day and night themes.
            </CardDescription>
          </CardHeader>
          <CardContent className="space-y-10">
           
          </CardContent>
        </Card>
        <Card>
          <CardHeader>
            <CardTitle>Reminder</CardTitle>
            <CardDescription>
              Customize the reminder frequency you are comfortable with.
            </CardDescription>
          </CardHeader>
          <CardContent className="space-y-10">
         
          
          </CardContent>
          <CardFooter>
            We&apos;ll send you a reminder email every day/weekly at 9:00 Pm UTC
          </CardFooter>
        </Card>
      </div>
    </Shell>
  )
}