import { ThemeProvider } from "../components/theme/theme-provider"
import { Inter as FontSans } from "next/font/google"
import { ClerkProvider } from '@clerk/nextjs';
import { siteConfig } from "../config/skylark"
import "../../globals.css"
import {cn } from "../lib/utils"
import localFont from "next/font/local"

export const metadata = {

  title: {
    default: siteConfig.name,
    template: `%s | ${siteConfig.name}`,
  },

  description: siteConfig.description,

  keywords: [
    "Bsu",
    "Bulsu",
    "Meneses",
    "Bsu Meneses",
    "Bulsu Meneses",
  ],

  authors: [
    {
      name: "John Deniel Dela Peña",
      url: "https://www.instagram.com/jaydeeclouds/",
    },
  ],

  creator: "John Deniel Dela Peña",

  themeColor: [
    { media: "(prefers-color-scheme: light)", color: "white" },
    { media: "(prefers-color-scheme: dark)", color: "black" },
  ],
  
  manifest: `${siteConfig.url}/site.webmanifest`,
}


// Font files can be colocated inside of `pages`
const fontHeading = localFont({
  src: "../fonts/CalSans-SemiBold.woff2",
  variable: "--font-heading",
})

const fontSans = FontSans({
  subsets: ["latin"],
  variable: "--font-sans",
})

interface RootLayoutProps {
  children: React.ReactNode
}

export default function RootLayout({ children }: RootLayoutProps) {
  return (
    <ClerkProvider>
      <html lang="en" suppressHydrationWarning>
        <head />
        <body
          className={cn(
            "min-h-screen bg-background font-sans antialiased",
            fontSans.variable,
            fontHeading.variable
          )}
        >
          <ThemeProvider attribute="class" defaultTheme="system" enableSystem>
            {children}
          </ThemeProvider>
        </body>
      </html>
    </ClerkProvider>
  )
}