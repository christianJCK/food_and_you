<?php

namespace BlogBundle\Entity;

/**
 * Tag
 */
class Tag
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $slug;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Tag
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Tag
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $blogPosts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->blogPosts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add blogPost
     *
     * @param \BlogBundle\Entity\Post $blogPost
     *
     * @return Tag
     */
    public function addBlogPost(\BlogBundle\Entity\Post $blogPost)
    {
        $this->blogPosts[] = $blogPost;

        return $this;
    }

    /**
     * Remove blogPost
     *
     * @param \BlogBundle\Entity\Post $blogPost
     */
    public function removeBlogPost(\BlogBundle\Entity\Post $blogPost)
    {
        $this->blogPosts->removeElement($blogPost);
    }

    /**
     * Get blogPosts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlogPosts()
    {
        return $this->blogPosts;
    }
}
