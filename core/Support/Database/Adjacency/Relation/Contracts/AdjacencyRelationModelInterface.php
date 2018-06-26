<?php

namespace Pluma\Support\Database\Adjacency\Relation\Contracts;

/**
 * Basic ClosureTable model interface.
 *
 * @package Franzose\ClosureTable
 */
interface AdjacencyRelationModelInterface
{
    /**
     * Get the short name of the "ancestor" column.
     *
     * @return string
     */
    public function getAncestorKey();

    /**
     * Get the short name of the "descendant" column.
     *
     * @return string
     */
    public function getDescendantKey();

    /**
     * Get the short name of the "depth" column.
     *
     * @return string
     */
    public function getDepthKey();

    /**
     * Inserts new node into closure table.
     *
     * @param int $ancestorId
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function insertNodeAsChildOf($ancestorId);

    /**
     * Make a node a descendant of another ancestor or makes it a root node.
     *
     * @param int $ancestorId
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function moveNodeTo($ancestorId = null);
}
