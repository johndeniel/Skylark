"use client"

import { FC } from "react"
import { cn } from "@/lib/utils"
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar"
import { Card, CardContent, CardFooter } from "@/components/ui/card"
import { Icons } from "@/components/icons"
import {latestConfig} from "@/config/latest"

interface LatestUpdateProps {
  className?: string
}

const LatestUpdate: FC<LatestUpdateProps> = ({ className }) => {
  return (
    <div
      className={cn(
        "grid grid-cols-1 gap-10 md:grid-cols-2 xl:grid-cols-3",
        className
      )}
    >
      {latestConfig.update.map((getUpdate) => (
        <div key={getUpdate.id}>
          <Card className="bg-transparent">
            <CardContent className="py-6">
              <p className="leading-relaxed text-muted-foreground">
                {getUpdate.content}
              </p>
            </CardContent>
            <CardFooter className="flex w-full items-center justify-between">
              <div className="flex items-center space-x-4">
                <Avatar>
                  <AvatarImage
                    alt={getUpdate.name}
                    src={getUpdate.avatar}
                  />
                  <AvatarFallback>{getUpdate.name}</AvatarFallback>
                </Avatar>
                <div>
                  <p className="text-sm font-medium leading-none">
                    {getUpdate.name}
                  </p>
                </div>
              </div>
              <Icons.logo className="w-5" />
            </CardFooter>
          </Card>
        </div>
      ))}
    </div>
  )
}

export default LatestUpdate
