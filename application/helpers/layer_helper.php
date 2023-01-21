<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function layer( 
    $array, 
    $hiddenLayers = array(), 
    $meta = array(
        'FRAME' => 'FRAMENONELAYOUT',
        'FIRSTFRAME' => true,
        'x' => 0,
        'y' => 0
    ),
    $parent = 0 ) {

    foreach ( $array as $object ) {

        // Validate Layer
        // Aici trebuei sa verificam toate cheile din layer tipurile si toate sub valorile din array sau obiect

        // Scoatem tipul la layer 
        $layerType = layerType($object);

        // echo $layerType . '>>>'; 

        // Desenam Layer
        if ( $layerType == 'FRAMEAUTOLAYOUT' || $layerType == 'FRAMENONELAYOUT' ) {

            if ( $object->id == '17:955' ) { 
                print_r($meta);
                print_r($object);
    
                die();
            }

            $meta['FRAME'] = $layerType;

            echo frameStart($object, $meta);

            if ( !$meta['FIRSTFRAME'] ) {
                $meta['x'] = $meta['x'] + $object->x;
                $meta['y'] = $meta['y'] + $object->y;
            }

            if ( $meta['FIRSTFRAME'] ) 
                $meta['FIRSTFRAME'] = false;
        }

        if ( $layerType == 'RECTANGLE' ) {

            $meta['x'][$object->id] = $meta['x'][$parent] + $object->x;
            $meta['y'][$object->id] = $meta['y'][$parent] + $object->y;

            echo rectangleStart($object);	
        }

        if ( $layerType == 'GROUPIMAGE' ) {
        
            $hiddenLayers[] = $object->id;

            echo groupImageStart($object);
        }

        if ( $layerType == 'TEXT' ) { 

            echo textStart($object, $meta);

            if ( $object->id == '1:2811' ) { 
                print_r($object);

                die();
            }
        }

        // Recursie
        if ( isset($object->children) && !in_array($object->id, $hiddenLayers) ) 
            layer($object->children, $hiddenLayers,  $meta, $parent);

        // Desenam Layer
        if ( $layerType == 'FRAMEAUTOLAYOUT' || $layerType == 'FRAMENONELAYOUT' ) 
            echo frameEnd($object);

        if ( $layerType == 'RECTANGLE' ) 
            echo rectangleEnd($object);

        if ( $layerType == 'GROUPIMAGE' ) 
            echo groupImageEnd($object);	

        if ( $layerType == 'TEXT' ) 
            echo textEnd($object);	
    }
}

function layerType($object) {

    if ( $object->type == 'GROUP' ) 
        return groupType($object);
        
    if ( $object->type == 'FRAME' ) 
        return frameType($object);

    else 
        return $object->type;
}

function layerLimit($key) { 
    $array = [
        'id',
        'parent',
        'type',
        'name',
        'visible',
        'locked',
        'opacity',
        'blendMode',
        'isMask',
        'effectStyleId',
        'x',
        'y',
        'width',
        'height',
        'rotation',
        'layoutAlign',
        'constrainProportions',
        'layoutGrow',	
        'layoutPositioning',
        'fillStyleId',	
        'strokeStyleId',	
        'strokeWeight',
        'strokeAlign',
        'strokeJoin',
        'strokeCap',	
        'strokeMiterLimit',
        'cornerRadius',
        'cornerSmoothing',
        'topLeftRadius',
        'topRightRadius',
        'bottomLeftRadius',
        'bottomRightRadius',
        'paddingLeft',
        'paddingRight',
        'paddingTop',
        'paddingBottom',
        'primaryAxisAlignItems',	
        'counterAxisAlignItems',
        'primaryAxisSizingMode',
        'strokeTopWeight',
        'strokeBottomWeight',
        'strokeLeftWeight',
        'strokeRightWeight',
        'gridStyleId',
        'backgroundStyleId',
        'clipsContent',
        'expanded',
        'layoutMode',
        'counterAxisSizingMode',
        'verticalPadding',
        'itemSpacing',
        'overflowDirection',
        'numberOfFixedChildren',
        'numberOfFixedChildren',
        'overlayPositionType',
        'overlayBackgroundInteraction',
        'itemReverseZIndex',
        'strokesIncludedInLayout',
        'listSpacing',
        'characters',
        'hasMissingFont',
        'fontSize',
        'paragraphIndent',
        'paragraphSpacing',
        'textCase',
        'textDecoration',
        'letterSpacing',
        'fontName',
        'fontWeight',
        'canUpgradeToNativeBidiSupport',
        'autoRename',
        'textAlignHorizontal',
        'textAlignVertical',
        'textAutoResize',
        'textStyleId',
        'description',
        'remote',
        'key',
        'variantPxroperties',
        'handleMirroring',
        'backgrounds',
        'stuckNodes',
        'attachedConnectors',
        'componentPropertyReferences',
        'effects',
        'absoluteRenderBounds',
        'absoluteBoundingBox',
        'dashPattern',
        'layoutGrids',
        'guides',
        'constraints',
        'overlayBackground',
        'reactions',
        'playbackSettings',
        'lineHeight',
        'hyperlink',
        'documentationLinks',
        'instances',
        'variantProperties',
        'componentPropertyDefinitions',
        'vectorNetwork',
    ];
    
    if ( !in_array($key, $array) ) 
        console($key, 'layerLimit');
}

function layerIgnore($key) { 
    $array = [
        'children',
        'relativeTransform',
        'absoluteTransform',
        'fills',
        'fillGeometry',
        'strokes',
        'strokeGeometry',
        'exportSettings',
        'vectorPaths',
    ];

    if ( !in_array($key, $array) ) 
        console($key, 'layerIgnore');
}

function backgroundLimit($key) {

    $array = [
        'type',
        'visible',
        'opacity',
        'blendMode',
        'color',
    ];

    if ( !in_array($key, $array) ) 
        console($key, 'backgroundLimit');
}