import { AppearanceForm } from "@/components/theme/appearance-form"
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card"
import { Separator } from "@/components/ui/separator"
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs"
import { Header } from "@/components/header"
import { Shell } from "@/components/shell"

import {

  OrganizationSwitcher,
  SignedIn,
} from "@clerk/nextjs";

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

      <Tabs defaultValue="appearance" className="hidden w-full md:block">

        <TabsList className="grid w-full grid-cols-2">
          <TabsTrigger value="account">Account</TabsTrigger>
          <TabsTrigger value="appearance">Appearance</TabsTrigger>
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
            <SignedIn>
          <div className="hidden sm:block">
            <OrganizationSwitcher afterCreateOrganizationUrl="/dashboard" />
          </div>
          <div className="block sm:hidden">
            <OrganizationSwitcher
              afterCreateOrganizationUrl="/dashboard"
              appearance={{
                elements: {
                  organizationSwitcherTriggerIcon: "hidden",
                  organizationPreviewTextContainer: "hidden",
                  organizationSwitcherTrigger: "pr-0",
                },
              }}
            />
          </div>
        </SignedIn>
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

      </Tabs>

      <div className="space-y-10 md:hidden">
        <Card>
            <CardHeader>
              <CardTitle>Appearance</CardTitle>
              <CardDescription>
                Customize the appearance of the app. Automatically switch between
                day and night themes.
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-10">
              <AppearanceForm />
            </CardContent>
          </Card>
        </div>
    </Shell>
  )
}