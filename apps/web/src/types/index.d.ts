import type { Icon } from "lucide-react"
import { Icons } from "../components/ui/icons"
import { type } from "os";

export type NavigationItem = {
  title: string;          
  href: string;            
  description: string;     
  disabled?: boolean;    
};

export type NavigationSection = {
  NavItem: NavigationItem[]; 
};



export type SidebarNavItem = {
  title: string
  disabled?: boolean
  external?: boolean
  icon?: keyof typeof Icons
} & (
  | {
      href: string
      items?: never
    }
  | {
      href?: string
      items: NavLink[]
    }
)

export type DashboardConfig = {
  sidebarNav: SidebarNavItem[]
}


export type LatestUpdateType = {
  id: number
  name: string
  avatar: string
  content: String
}

export type LatestUpdate = {
  update: LatestUpdateType[];
}

export type SiteConfig = {
  name: string
  description: string
  url: string
  ogImage: string
  links: {
    github: string
    docs: string
  }
}